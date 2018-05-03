import * as React from 'react';
//import * as  ReactDOM from 'react-dom';

//import { CounterProp } from './interfaces/CounterProp';
//import { CounterState } from './interfaces/CounterState';
//import ShareableDriversList from './components/ShareableDriversList';

//import * as  openSocket from 'socket.io-client';
//const socket = openSocket('http://localhost:8000');

//declare let reactData:CounterProp;
 
//export default class FamilyViewCreate extends React.Component<CounterProp,CounterState> {
export default class Ticker extends React.Component {

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

    render() {
        //return <div><ShareableDriversList initValue={this.state.value} /> - {this.state.value}</div>;
         return <div>REACT TICKER</div>;
    }
}