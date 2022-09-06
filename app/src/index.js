import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import App from './App';
import reportWebVitals from './reportWebVitals';

const server = process.env.NODE_ENV;
const icData = window.metaNinjaReactApp || {};
const view = window.metaNinjaView || {};

let root = null;

console.log(process.env.NODE_ENV);
console.log(view);

if (server === 'development') {
	root = ReactDOM.createRoot(document.getElementById('root'));
} else {
	const { appSelector } = window.metaNinjaReactApp || {};
	const appAnchorElement = document.querySelector(appSelector);
	if (appAnchorElement) {
		root = ReactDOM.createRoot(appAnchorElement);
	}
}

root.render(
	<React.StrictMode>
		<App icData={icData} view={view} />
	</React.StrictMode>
);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();
