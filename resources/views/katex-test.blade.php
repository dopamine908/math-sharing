<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.13.13/dist/katex.min.css"
          integrity="sha384-RZU/ijkSsFbcmivfdRBQDtwuwVqK7GMOw6IMvKyeWL2K5UAlyp6WonmB8m7Jd0Hn" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.13.13/dist/katex.min.js"
            integrity="sha384-pK1WpvzWVBQiP0/GjnvRxV4mOb0oxFuyRxJlk6vVw146n3egcN5C925NCP7a7BY8"
            crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.13.13/dist/contrib/auto-render.min.js"
            integrity="sha384-vZTG03m+2yp6N6BNi5iM4rW4oIwk5DfcNdFfxkk9ZWpDriOkXX8voJBFrAO7MpVl"
            crossorigin="anonymous"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            renderMathInElement(document.body, {
                // customised options
                // • auto-render specific keys, e.g.:
                // delimiters: [
                //     {left: '$$', right: '$$', display: true},
                //     {left: '$', right: '$', display: false},
                //     {left: '\$\$', right: '\$\$', display: false},
                //     {left: '\\(', right: '\\)', display: false},
                //     {left: '\\[', right: '\\]', display: true}
                // ],
                // • rendering keys, e.g.:
                throwOnError: false
            });
        });
    </script>
    <title>Document</title>
</head>
<body>
You can write text, that contains expressions like this: $x ^ 2 + 5$ inside them. As you probably know. You also can
write expressions in display mode as follows: $$\sum_{i=1}^n(x_i^2 - \overline{x}^2)$$. In first case you will need to
use \$expression\$ and in the second one \$\$expression\$\$. To scape the \$ symbol it's mandatory to write as follows:
\\$
</body>
</html>
