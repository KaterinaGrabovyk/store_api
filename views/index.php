<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>API Документація</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swagger-ui-dist/swagger-ui.css">
    <style>
        body { margin: 0; padding: 0; }
        .swagger-ui { margin-top: 20px; }
    </style>
</head>
<body>
    <div id="swagger-ui"></div>
    <script src="https://cdn.jsdelivr.net/npm/swagger-ui-dist/swagger-ui-bundle.js"></script>
    <script>
      window.onload = function() {
        SwaggerUIBundle({
          url: '/openapi.json', 
          dom_id: '#swagger-ui',
        });
      };
    </script>
</body>
</html>
