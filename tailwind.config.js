module.exports = {
    theme: {
        extend: {
            skew: {
                '30': '30deg',
                '20': '20deg',
            },
            colors: {
                'main': '#76b38f',
            },
            fontFamily: {
                'sansita': ['Sansita Swashed', 'font-family'],
            },
            backgroundImage: {
                'selected-date-range-start': "linear-gradient(to right, #ffffff 50% , #4F46E5 50%);",
                'selected-date-range-end': "linear-gradient(to left, #ffffff 50% , #4F46E5 50%);",
                'reserved-date-range-start': "linear-gradient(to right, #F9FAFB 50% , #DC2626 50%);",
                'reserved-date-range-end': "linear-gradient(to left, #F9FAFB 50% , #DC2626 50%);",
                'selected-reserved-date-range-start': "linear-gradient(to right, #DC2626 50% , #4F46E5 50%);",
                'selected-reserved-date-range-end': "linear-gradient(to left, #DC2626 50% , #4F46E5 50%);"
            }
        }
    },
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/aspect-ratio'),
    ],
}
