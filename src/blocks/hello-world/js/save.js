import { useBlockProps } from '@wordpress/block-editor';

export const Save = ({ attributes }) => {
	const blockProps = useBlockProps.save();
	const { title, subtitle } = attributes;
	return (
		<div {...blockProps}>
			<h1>{title}</h1>
			<h2>{subtitle}</h2>
		</div>
	);
};
