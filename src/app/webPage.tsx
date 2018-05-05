//import { Base } from '../core/Base';
//import BTCPrice from '../components/BTCPrice';
//import GRCPrice from '../components/GRCPrice';
import BlockChart from '../components/BlockChart';
import DoughnutChart from '../components/DoughnutChart';
//import BlockHeight from '../components/BlockHeight';
import * as React from 'react';
import * as  ReactDOM from 'react-dom';
//import { IWebPageData } from '../interfaces/iWebPageData';
//import {Doughnut} from 'react-chartjs-2';
//
//export default class Chart extends React.Component<any,any> {
//     
//     static defaultProps = {
//          displayTitle : true,
//          displayLegend : true
//     }
//     
//     componentWillMount() {
//          // get data
//     }
//     
//     constructor(props:any,state:any) {
//          super(props);
//          this.state = {
//               chartData : {
//                    labels : ['Red','Blue','Yellow'],
//                    datasets : [
//                         {
//                              label : "My First Dataset",
//                              data : [
//                                   300,100,50
//                              ],
//                              backgroundColor : [
//                                   "rgb(255, 99, 132)",
//                                   "rgb(54, 162, 235)",
//                                   "rgb(255, 205, 86)"
//                              ]
//                         }
//                    ]                    
//               }
//          }
//     }
//    
//     render() {
//          return <Doughnut
//                    data={this.state.chartData}
//                    options={
//                         {
//                              legend : {
//                                   display : this.props.displayLegend
//                              } 
//                         }    
//                    }
//          />
//     }
//                              <script>                                     
//                              var chart = new Chart(document.getElementById("chartjs-4"),{
//                                   "type":"doughnut",
//                                  "title" : "whatever",
//                                   "data":{"labels":["Red","Blue","Yellow"],
//                                   "datasets":[
//                                        {
//                                             "label":"My First Dataset",
//                                             "data":[300,50,100],
//                                             "backgroundColor":["rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86)"]
//                                        }
//                                   ]}});
//                              setTimeout(function() {
//                                   console.log("CHANGE");
//                                   console.log(chart.data.datasets[0].data[0]);
//                                   chart.data.datasets[0].data[0] = 100;
//                                   chart.update();
//                              },2000);
//
//                                        
//                          </script>

//}
//     
//     constructor() {
//          super();
//          console.log("CONS");
//          ReactDOM.render(<Ticker />, document.getElementById('ticker'));
//          
//          //this.socket.on('ticker',(data:any) => {
//          //     console.log(data);
//          //});
//          
//          //var room = this.socket.io('/my-namespace');
//          //console.log(room);
//          
//          console.log(this.socket);
//          
//          this.socket.on('connect',() => {
//             console.log("CONNECTION");
//               this.socket.emit('room','tickerRoom');                 
//          });
//          
//          this.socket.on('updateTicker',(data:any)=>{
//             console.log(data);  
//          });
//          
//     }
//     
//     
//}
//
//new WebPage();

//import socket from '../core/Socket';

var components = {
     Chart : BlockChart,
     DoughnutChart : DoughnutChart
}

window.renderComponent = (id:string,component:string,data:any) => {
     console.log("######################" + id);
     console.log(component);
     console.log(data);
     let TagName = components[component];
     ReactDOM.render(
         <TagName {...data}/>,
         document.getElementById(id)
     );
};

//declare let reactWebPageData:IWebPageData;
//
//ReactDOM.render(<GRCPrice price={reactWebPageData.GRCPrice} />,document.getElementById('react-GRCPrice'));
//ReactDOM.render(<BTCPrice />,document.getElementById('react-BTCPrice'));
//ReactDOM.render(<BlockHeight />,document.getElementById('react-BlockHeight'));
//ReactDOM.render(<Chart displayLegend={false}/>,document.getElementById('chartjs-4'));


//import { CounterProp } from './interfaces/CounterProp';
//import { CounterState } from './interfaces/CounterState';
//import ShareableDriversList from './components/ShareableDriversList';

//import * as  openSocket from 'socket.io-client';
//const socket = openSocket('http://localhost:8000');

//
 
//export default class FamilyViewCreate extends React.Component<CounterProp,CounterState> {
//export default class WebPage extends React.Component {

     //constructor(props,state) {
          //super(props,state);
          //this.state = {value : this.props.initValue}
          //socket.on('timer', timestamp => cb(null, timestamp));
          //socket.emit('subscribeToTimer', 1000);
          //this.increase();
     //}

//componentDidMount() {  
//     console.log("did");
//}
//
//componentWillReceiveProps() {
//console.log("recv");
//}

//     increase() {
//          this.setState({value : this.state.value + 1});
//          setTimeout(this.increase.bind(this), 1000);
//     }

//    render() {
        //return <div><ShareableDriversList initValue={this.state.value} /> - {this.state.value}</div>;
//         return <div>ABCDEFGDDD</div>;
//    }

//ReactDOM.render(<Ticker />, document.getElementById('ticker'));
