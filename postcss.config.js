import postcssNested from 'postcss-nesting';
import tailwindcss from 'tailwindcss';
import autoprefixer from 'autoprefixer';

export default {
    plugins: [
        postcssNested,
        tailwindcss(),
        autoprefixer(),
    ],
};