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
console.log(getBlockTypes());
console.log(getCategories());