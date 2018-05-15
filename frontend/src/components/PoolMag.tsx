import {
    SocketManager
} from '../core/SocketManager';
import * as React from 'react';
import {
    Pie
} from 'react-chartjs-2';

export default class PoolMag extends React.Component <any, any > {

    private _blockTime: number;
    
    constructor(props: any, state: any) {
        super(props);
        let dataArray:number[] = new Array();
        let labelArray:string[] = new Array();
        let keyLength:number = Object.keys(props).length;
        for (let i:number = 1; i <= keyLength; i++) {
            dataArray.push(parseInt(props[i]));
            labelArray.push('Pool '+i);
        }
        this.state = {
            chartData: {
                labels: labelArray,
                datasets: [{
                    label: "",
                    data: dataArray,
                    backgroundColor: [
                        "rgb(255,99,132)",
                        "rgb(99,255,132)",
                        "rgb(99,132,255)",
                        "yellow",
                        "magenta",
                        "cyan"
                    ]
                }]
            },
            chartOptions: {
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
                let data:any = JSON.parse(rawData);
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
        return <Pie
        data = {
            this.state.chartData
        }
        options = {
            this.state.chartOptions
        }
        />
    }
}