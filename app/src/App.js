import './App.css';
import { useEffect } from 'react';
import ConfigContext from './contexts/configContext';
import ViewContext from './contexts/viewContext';
import { CssBaseline, ThemeProvider } from '@mui/material';
import Admin from './views/Admin';

function App({ dataConfig, view }) {
	useEffect(() => {
		console.log(view);
	}, [view]);

	return (
		<ConfigContext.Provider value={dataConfig}>
			<ViewContext.Provider value={view}>
				<CssBaseline />
				<ThemeProvider>{view && view.page === 'admin' && <Admin />}</ThemeProvider>
			</ViewContext.Provider>
		</ConfigContext.Provider>
	);
}

export default App;
