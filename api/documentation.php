<!DOCTYPE html>
<html>

<head>
    <title>Bible API - Docs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/5.1.3/swagger-ui.css" integrity="sha512-sgYTxpBWckqYBbs7HbUcAZPpLq2nBqtITfwlXc8tIG+8OgusT3YUwoKIwYYX6vCkNbsknr2FELbgB2sqVe5zZw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div id="ui-wrapper-new" data-spec="{{spec}}">
        Loading....
    </div>
    <footer style="position: fixed; width: 100%; bottom: 10px; text-align: center;">
      Gabriel Silvério &copy; <?php echo date('Y') ?>
    </footer>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/5.1.3/swagger-ui-bundle.js" integrity="sha512-Ykto0zfR5srIdvI1T4vbYEWEPEMFtWOKz8E4/t1SYf/gcXuiuDEbtOoXH4p6887kY3O3GezjApLzFmPbrZ+54w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var swaggerUIOptions = {
      url: "openapi",
      dom_id: '#ui-wrapper-new', // Determine what element to load swagger ui
      docExpansion: 'list',
      deepLinking: true, // Enables dynamic deep linking for tags and operations
      filter: true,
      presets: [
        SwaggerUIBundle.presets.apis,
        SwaggerUIBundle.SwaggerUIStandalonePreset
      ],
      plugins: [
        SwaggerUIBundle.plugins.DownloadUrl
      ],
    }

    var ui = SwaggerUIBundle(swaggerUIOptions)

    setTimeout(function() {
      const title = document.getElementsByClassName('title')[0];
      const span = title.getElementsByTagName('span')[0];
      span.innerHTML += '<a href="https://github.com/gsilverio7/PHPBibleAPI" target="_blank">'
        + '<small style="background: #fff; position: relative; top: -8px; left: -2px">'
        + '<img width="20px" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0Ij48cGF0aCBkPSJNMTIgMGMtNi42MjYgMC0xMiA1LjM3My0xMiAxMiAwIDUuMzAyIDMuNDM4IDkuOCA4LjIwNyAxMS4zODcuNTk5LjExMS43OTMtLjI2MS43OTMtLjU3N3YtMi4yMzRjLTMuMzM4LjcyNi00LjAzMy0xLjQxNi00LjAzMy0xLjQxNi0uNTQ2LTEuMzg3LTEuMzMzLTEuNzU2LTEuMzMzLTEuNzU2LTEuMDg5LS43NDUuMDgzLS43MjkuMDgzLS43MjkgMS4yMDUuMDg0IDEuODM5IDEuMjM3IDEuODM5IDEuMjM3IDEuMDcgMS44MzQgMi44MDcgMS4zMDQgMy40OTIuOTk3LjEwNy0uNzc1LjQxOC0xLjMwNS43NjItMS42MDQtMi42NjUtLjMwNS01LjQ2Ny0xLjMzNC01LjQ2Ny01LjkzMSAwLTEuMzExLjQ2OS0yLjM4MSAxLjIzNi0zLjIyMS0uMTI0LS4zMDMtLjUzNS0xLjUyNC4xMTctMy4xNzYgMCAwIDEuMDA4LS4zMjIgMy4zMDEgMS4yMy45NTctLjI2NiAxLjk4My0uMzk5IDMuMDAzLS40MDQgMS4wMi4wMDUgMi4wNDcuMTM4IDMuMDA2LjQwNCAyLjI5MS0xLjU1MiAzLjI5Ny0xLjIzIDMuMjk3LTEuMjMuNjUzIDEuNjUzLjI0MiAyLjg3NC4xMTggMy4xNzYuNzcuODQgMS4yMzUgMS45MTEgMS4yMzUgMy4yMjEgMCA0LjYwOS0yLjgwNyA1LjYyNC01LjQ3OSA1LjkyMS40My4zNzIuODIzIDEuMTAyLjgyMyAyLjIyMnYzLjI5M2MwIC4zMTkuMTkyLjY5NC44MDEuNTc2IDQuNzY1LTEuNTg5IDguMTk5LTYuMDg2IDguMTk5LTExLjM4NiAwLTYuNjI3LTUuMzczLTEyLTEyLTEyeiIvPjwvc3ZnPg==">'
        + '</small>'
        + '</a>';
    }, 500);


    /** Export to window for use in custom js */
    window.ui = ui
</script>
</html>