/**
 * WordPress dependencies.
 */
import { registerBlockType, getBlockTypes, getCategories } from '@wordpress/blocks';

/**
 * Blocks.
 */ 
import helloWorld from './hello-world/block';

const blocks = [
	helloWorld,
];

blocks.forEach((settings) => registerBlockType( settings.name, { title: settings.title, edit: settings.edit, save: settings.save}));
 
registerBlockType('awp/firstblock', {
	title: 'My first block',
	category: 'admin-comments',
	icon: 'smiley',
	description: 'Learning in progress',
	keywords: ['example', 'test'],
	edit: () => { 
		return <div>:)</div> 
	},
	save: () => { 
		return <div>:)</div> 
	}
});
console.log(getBlockTypes());
 console.log(getCategories());