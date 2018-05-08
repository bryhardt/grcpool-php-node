import {SocketManager} from '../core/SocketManager';
import * as React from 'react';
import {Doughnut} from 'react-chartjs-2';

export default class BlockNumberCounter extends React.Component<any,any> {
     
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
                                   "rgb(255, 255,255)"
                              ]
                         }
                    ]                    
               }
          }
          
//          let nut = chartjs.Chart.controllers.dougnut.prototype.draw;
//          chartjs.Chart.helpers.extend(chartjs.controllers.doughnut.prototype, {
//               
//          });
    

          
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
                              cutoutPercentage : 90,
                              legend : {
                                   display : false
                              } 
                         }    
                    }
          />
     }
}