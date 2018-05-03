//import { Base } from '../core/Base';
import BTCPrice from '../components/BTCPrice';
import GRCPrice from '../components/GRCPrice';
import BlockHeight from '../components/BlockHeight';
import * as React from 'react';
import * as  ReactDOM from 'react-dom';
import { IWebPageData } from '../interfaces/iWebPageData';

//export default class WebPage extends Base {
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

declare let reactWebPageData:IWebPageData;

ReactDOM.render(<GRCPrice price={reactWebPageData.GRCPrice} />,document.getElementById('react-GRCPrice'));
ReactDOM.render(<BTCPrice />,document.getElementById('react-BTCPrice'));
ReactDOM.render(<BlockHeight />,document.getElementById('react-BlockHeight'));

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
//}

//ReactDOM.render(<Ticker />, document.getElementById('ticker'));
