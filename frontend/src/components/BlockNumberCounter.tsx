import {
    SocketManager
} from '../core/SocketManager';
import * as React from 'react';
import {
    Doughnut
} from 'react-chartjs-2';

interface UpdateBlockData {
    blockHeight: number;
    blockTime: number;
    blockHash: string;
}

export default class BlockNumberCounter extends React.Component <UpdateBlockData, any > {

    private _blockTime: number;
    private _blockHeight : number;

    constructor(props: UpdateBlockData, state: any) {
        super(props);
        this._blockTime = this.props.blockTime;
        this._blockHeight = this.props.blockHeight;
        this.state = {
            chartData: {
                labels: [],
                datasets: [{
                    label: "",
                    data: [
                        0, 100
                    ],
                    backgroundColor: [
                        "rgb(99, 255, 132)",
                        "rgb(255, 255,255)"
                    ]
                }]
            },
            chartOptions: {
                elements: {
                    center: {
                        text: this._blockHeight,
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
            SocketManager.Instance.socket.emit('room', 'homeIndex');
            SocketManager.Instance.socket.on('updateBlock', (rawData: string) => {
                let data: UpdateBlockData = JSON.parse(rawData);
                this._blockTime = data.blockTime;
                this._blockHeight = data.blockHeight;
                this.forceUpdate();
            });
        });
        setInterval(this.doInterval, 2000);
    }

    private updateState() {
        let diff: number = Math.floor(Date.now() / 1000) - this._blockTime;
        diff = diff > 100 ? 100 : diff;
        this.state.chartData.datasets[0].data = [diff, 100 - diff];
        this.state.chartOptions.elements.center.text = this._blockHeight;
        this.state.chartData.datasets[0].backgroundColor[0] = diff < 100 ?"rgb(99, 255, 132)":"rgb(255, 99, 132)";
        this.state.chartOptions.elements.center.color = diff < 100 ?"rgb(99, 255, 132)":"rgb(255, 99, 132)";         
        this.forceUpdate();                  
    }
    
    private doInterval = () => {
        this.updateState();
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