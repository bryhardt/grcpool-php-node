import BlockNumberCounter from '../components/BlockNumberCounter';
import SuperBlockNumberCounter from '../components/SuperBlockNumberCounter';
import * as React from 'react';
import * as  ReactDOM from 'react-dom';

var components = {
     BlockNumberCounter : BlockNumberCounter,
     SuperBlockNumberCounter : SuperBlockNumberCounter
}

window.renderComponent = (id:string,component:string,data:any) => {
     let TagName = components[component];
     ReactDOM.render(
         <TagName {...data}/>,
         document.getElementById(id)
     );
};