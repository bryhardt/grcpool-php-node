import {SocketManager} from '../core/SocketManager';
import * as React from 'react';
//import * as  ReactDOM from 'react-dom';

//import { CounterProp } from './interfaces/CounterProp';
//import { CounterState } from './interfaces/CounterState';
//import ShareableDriversList from './components/ShareableDriversList';

//import * as  openSocket from 'socket.io-client';
//const socket = openSocket('http://localhost:8000');

//declare let reactData:CounterProp;
 
//export default class FamilyViewCreate extends React.Component<CounterProp,CounterState> {

interface IPrice {
     price : number;
}

export default class GRCPrice extends React.Component<IPrice,IPrice> {

     constructor(props:IPrice,state:IPrice) {
          super(props,state);
          this.state = {price : this.props.price}
     }

     componentDidMount() {  
          SocketManager.Instance.socket.on('connect',() => {
               console.log("GRC PRICE CONNECTION");
               //this.socket.emit('room','tickerRoom');                 
          });
//          
//          this.socket.on('updateTicker',(data:any)=>{
//             console.log(data);  
//          });

     }
//
//componentWillReceiveProps() {
//console.log("recv");
//}

//     increase() {
//          this.setState({value : this.state.value + 1});
//          setTimeout(this.increase.bind(this), 1000);
//     }

    render() {
        //return <div><ShareableDriversList initValue={this.state.value} /> - {this.state.value}</div>;
         return <div>{this.state.price.toFixed(8)}</div>;
    }
}