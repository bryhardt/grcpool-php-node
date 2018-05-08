import {SocketManager} from '../core/SocketManager';
import * as React from 'react';
import * as chartjs from "chart.js";
import {Doughnut} from 'react-chartjs-2';

export default class BlockChart extends React.Component<any,any> {
     
     private _blockTime:number;
     
//     static defaultProps = {
//          displayTitle : false,
//          displayLegend : false
//     }
     
     constructor(props:any,state:any) {
          super(props);
          this._blockTime = this.props.blockTime | Math.floor(Date.now() / 1000);
          this.state = {
               chartData : {
                    labels : ['Red','Blue','Yellow'],
                    datasets : [
                         {
                              label : "My First Dataset",
                              data : [
                                   0,100
                              ],
                              backgroundColor : [
                                   "rgb(255, 99, 132)",
                                   "rgb(0, 0, 0)"
                              ]
                         }
                    ]                    
               }
          }
          
//          let nut = chartjs.Chart.controllers.dougnut.prototype.draw;
//          chartjs.Chart.helpers.extend(chartjs.controllers.doughnut.prototype, {
//               
//          });
          
            
         
            chartjs.Chart.pluginService.register({
                 beforeDraw: function(chart:any) {
                    if (chart.config.options.elements.center) {
                     //Get ctx from string
                     var ctx = chart.chart.ctx;
               
                     //Get options from the center object in options
                     var centerConfig = chart.config.options.elements.center;
                     var fontStyle = centerConfig.fontStyle || 'Arial';
                     var txt = centerConfig.text;
                     var color = centerConfig.color || '#000';
                     var sidePadding = centerConfig.sidePadding || 20;
                     var sidePaddingCalculated = (sidePadding/100) * (chart.innerRadius * 2)
                     //Start with a base font of 30px
                     ctx.font = "30px " + fontStyle;
               
                     //Get the width of the string and also the width of the element minus 10 to give it 5px side padding
                     var stringWidth = ctx.measureText(txt).width;
                     var elementWidth = (chart.innerRadius * 2) - sidePaddingCalculated;
               
                     // Find out how much the font can grow in width.
                     var widthRatio = elementWidth / stringWidth;
                     var newFontSize = Math.floor(30 * widthRatio);
                     var elementHeight = (chart.innerRadius * 2);
               
                     // Pick a new font size so it will not be larger than the height of label.
                     var fontSizeToUse = Math.min(newFontSize, elementHeight);
               
                     //Set font settings to draw it correctly.
                     ctx.textAlign = 'center';
                     ctx.textBaseline = 'middle';
                     var centerX = ((chart.chartArea.left + chart.chartArea.right) / 2);
                     var centerY = ((chart.chartArea.top + chart.chartArea.bottom) / 2);
                     ctx.font = fontSizeToUse+"px " + fontStyle;
                     ctx.fillStyle = color;
               
                     //Draw text in center
                     ctx.fillText(txt, centerX, centerY);
                   }       
                 }
            });
          
//          chartjs.Chart.types.Doughnut.extend({
//               
//          });
          
          //Doughnut.extend({});
          //let originalDoughnutDraw = Chart.controllers.doughnut.prototype.draw;
          
          //Plugin for center text
//          Doughnut.pluginService.register({
//            beforeDraw: function(chart) {
//              var width = chart.chart.width,
//              height = chart.chart.height,
//              ctx = chart.chart.ctx;
//              ctx.restore();
//              var fontSize = (height / 160).toFixed(2);
//              ctx.font = fontSize + "em sans-serif";
//              ctx.textBaseline = "top";
//              var text = "Foo-bar",
//              textX = Math.round((width - ctx.measureText(text).width) / 2),
//              textY = height / 2;
//              ctx.fillText(text, textX, textY);
//              ctx.save();
//            }
//          });          
     }
     
     componentWillMount() {
          // get data
     }
     
     componentDidMount() {
          SocketManager.Instance.socket.on('connect',() => {
               console.log("GRC PRICE CONNECTION");
               SocketManager.Instance.socket.on('updateBlock',(data:any) => {
                    console.log("UPDATE BLOCK");
                    //this.setState({value : this.state.value + 1});
                    this._blockTime = Math.floor(Date.now() / 1000);                  
                    this.state.chartData.datasets[0].data = [0,100];
                    this.forceUpdate();
               });
          });
          setInterval(this.doInterval,1000);
     }
    
     private doInterval = () => {
          let diff:number = Math.floor(Date.now() / 1000) - this._blockTime;
          diff = diff > 100 ? 100 : diff;
          this.state.chartData.datasets[0].data = [diff,100-diff];
          this.forceUpdate();          
     }
    
     render() {
          return <Doughnut
                    data={this.state.chartData}
                    options={
                         {
                              elements : {
                                    center: {
                                        text: 'Desktop',
                                        color: '#36A2EB', //Default black
                                        fontStyle: 'Helvetica', //Default Arial
                                        sidePadding: 15 //Default 20 (as a percentage)
                                   }
                              },
                              cutoutPercentage : 90,
                              legend : {
                                   display : false
                              } 
                         }    
                    }
          />
     }
}