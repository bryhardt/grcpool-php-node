import * as openSocket from 'socket.io-client';

export class SocketManager {
     
     private static _instance : SocketManager;
     public socket : any;
     
     constructor() {
          this.socket = openSocket('https://beta.grcpool.com/');          
     }
     
     public static get Instance() {
          return this._instance || (this._instance = new this());    
     }
     
}