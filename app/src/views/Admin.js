import React, { useContext, useEffect } from 'react';
import ViewContext from '../contexts/viewContext';

function Admin() {
	const view = useContext(ViewContext);
	useEffect(() => {
		console.log(view);
	}, []);
	console.log(view);
	return <div>Admin</div>;
}

export default Admin;
