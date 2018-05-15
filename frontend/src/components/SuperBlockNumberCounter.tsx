import {
    SocketManager
} from '../core/SocketManager';
import * as React from 'react';
import {
    Doughnut
} from 'react-chartjs-2';

interface UpdateSuperBlockData {
    blockHeight: number;
    blockTime: number;
    blockHash: string;
}

export default class SuperBlockNumberCounter extends React.Component <UpdateSuperBlockData, any > {

    private _blockTime: number;

    constructor(props: UpdateSuperBlockData, state: any) {
        super(props);
        this._blockTime = this.props.blockTime;
        let diff:number = this.getBlockTimeDiff();
        this.state = {
            chartData: {
                labels: [],
                datasets: [{
                    label: "",
                    data: [
                        diff,100-diff
                    ],
                    backgroundColor: [
                        diff < 100 ? "rgb(99, 255, 132)" : "rgb(255,99,132)",
                        "rgb(255, 255,255)"
                    ]
                }]
            },
            chartOptions: {
                elements: {
                    center: {
                        text: props.blockHeight,
                        color: 'rgb(99, 255, 132)',
                        fontStyle: 'Helvetica',
                        sidePadding: 15
                    }
                },
                cutoutPercentage: 90,
                legend: {
                    display: false
                }
            }
        }


    }

    componentWillMount() {
        // get data
    }

    componentDidMount() {
        SocketManager.Instance.socket.on('connect', () => {
            SocketManager.Instance.socket.emit('app', 'superBlock');
            SocketManager.Instance.socket.on('update', (rawData: string) => {
                let data: UpdateSuperBlockData = JSON.parse(rawData);
                this._blockTime = data.blockTime;
                 console.log('socket');console.log(data.blockTime);
                this.state.chartOptions.elements.center.text = data.blockHeight;
                let diff = this.getBlockTimeDiff();
                this.state.chartData.datasets[0].data = [diff, 100 - diff];
                this.forceUpdate();
            });
        });
        setInterval(this.doInterval, 300000);
    }

     
    private getBlockTimeDiff():number {
        let diff:number = Math.floor(Date.now() / 1000) - this._blockTime;
        return diff > 129600 ? 100 : Math.floor(100*diff/129600);                 
    }
     
    private doInterval = () => {
        let diff:number = this.getBlockTimeDiff();
        this.state.chartData.datasets[0].data = [diff, 100 - diff];
        this.forceUpdate();
    }

    render() {
        return <Doughnut
        data = {
            this.state.chartData
        }
        options = {
            this.state.chartOptions
        }
        />
    }
}