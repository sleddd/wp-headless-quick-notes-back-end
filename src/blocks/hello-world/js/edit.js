import { __ } from '@wordpress/i18n';
import { RichText, useBlockProps } from '@wordpress/block-editor';

export const Edit = ({ attributes, setAttributes }) => {
	const blockProps = useBlockProps({ className: 'hello-world' });
	return (
		<div {...blockProps}>
			<RichText
				tagName="h1"
				placeholder={__('Write title…')}
				value={attributes.title}
				onChange={(title) => setAttributes({ title })}
				keepPlaceholderOnFocus={true}
			/>
			<RichText
				tagName="h2"
				placeholder={__('Write subtitle…')}
				value={attributes.subtitle}
				onChange={(subtitle) => setAttributes({ subtitle })}
				keepPlaceholderOnFocus={true}
			/>
		</div>
	);
};
