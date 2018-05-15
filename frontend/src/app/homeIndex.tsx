import BlockNumberCounter from '../components/BlockNumberCounter';
import SuperBlockNumberCounter from '../components/SuperBlockNumberCounter';
import PoolNetworkMag from '../components/PoolNetworkMag';
import PoolMag from '../components/PoolMag';
import * as React from 'react';
import * as  ReactDOM from 'react-dom';
import * as chartjs from "chart.js";

var components = {
     BlockNumberCounter : BlockNumberCounter,
     SuperBlockNumberCounter : SuperBlockNumberCounter,
     PoolNetworkMag : PoolNetworkMag,
     PoolMag : PoolMag
}
window.renderComponent = (id:string,component:string,data:any) => {
    if (components[component]) {
        let TagName = components[component];
        ReactDOM.render(
            <TagName {...data}/>,
            document.getElementById(id)
        );
    }
};
    
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
    