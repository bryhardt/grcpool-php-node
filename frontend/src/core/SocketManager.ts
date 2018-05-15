import * as openSocket from 'socket.io-client';

export class SocketManager {
     
     private static _instance : SocketManager;
     public socket : any;
     
     constructor() {
          this.socket = process.env.NODE_ENV=='development'?
          openSocket('http://localhost:3002/'):          
          openSocket('https://beta.grcpool.com/');
     }
     
     public static get Instance() {
          return this._instance || (this._instance = new this());    
     }
     
}