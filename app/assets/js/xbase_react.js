import React from 'react';
import ReactDom from 'react-dom';
import { createRoot } from 'react-dom/client';
import CustomerApp from './XBase/CustomerApp';
import TestApp from "./XBase/TestApp";


const container = document.getElementById('remixx-app');
const root = createRoot(container);

const el = <h2>Lift Stuff! <span>❤️❤❤❤</span></h2>;


root.render(
    <div>
       {/*<TestApp />*/}
        <CustomerApp />


        {/*/>*/}
    </div>,
);