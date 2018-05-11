import {
    SocketManager
} from '../core/SocketManager';
import * as React from 'react';
import {
    Doughnut
} from 'react-chartjs-2';
import * as chartjs from "chart.js";

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