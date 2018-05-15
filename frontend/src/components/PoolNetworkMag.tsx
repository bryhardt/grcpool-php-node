import {
    SocketManager
} from '../core/SocketManager';
import * as React from 'react';
import {
    Doughnut
} from 'react-chartjs-2';
import * as chartjs from "chart.js";

interface UpdateSuperBlockData {
    blockHeight: number;
    blockTime: number;
    blockHash: string;
}

export default class PoolNetworkMag extends React.Component <UpdateSuperBlockData, any > {

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

        chartjs.Chart.pluginService.register({
            beforeDraw: function(chart: any) {
                if (chart.config.options.elements.center) {
                    var ctx = chart.chart.ctx;
                    var centerConfig = chart.config.options.elements.center;
                    var fontStyle = centerConfig.fontStyle || 'Arial';
                    var txt = centerConfig.text;
                    var color = centerConfig.color || '#000';
                    var sidePadding = centerConfig.sidePadding || 20;
                    var sidePaddingCalculated = (sidePadding / 100) * (chart.innerRadius * 2)
                    ctx.font = "30px " + fontStyle;
                    var stringWidth = ctx.measureText(txt).width;
                    var elementWidth = (chart.innerRadius * 2) - sidePaddingCalculated;
                    var widthRatio = elementWidth / stringWidth;
                    var newFontSize = Math.floor(30 * widthRatio);
                    var elementHeight = (chart.innerRadius * 2);
                    var fontSizeToUse = Math.min(newFontSize, elementHeight);
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    var centerX = ((chart.chartArea.left + chart.chartArea.right) / 2);
                    var centerY = ((chart.chartArea.top + chart.chartArea.bottom) / 2);
                    ctx.font = fontSizeToUse + "px " + fontStyle;
                    ctx.fillStyle = color;
                    ctx.fillText(txt, centerX, centerY);
                }
            }
        });

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