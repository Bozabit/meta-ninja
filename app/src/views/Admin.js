import React, { useContext, useEffect } from 'react';
import ViewContext from '../contexts/viewContext';

function Admin() {
	const view = useContext(ViewContext);
	useEffect(() => {
		console.log(view);
	}, []);
	console.log(view);
	return (
		<div className='flex w-[100%] h-96'>
			<div className='w-96 text-center m-auto'>
				Here will be and awesome admin dashboard. If you wish to contribute go ahead an visit
				https://github.com/Bozabit/meta-ninja
			</div>
		</div>
	);
}

export default Admin;
