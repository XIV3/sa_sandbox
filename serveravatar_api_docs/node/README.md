# Detail

Retrieve details for the Node application on a Node Stack server.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/node-deployment
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/1/servers/13/applications/223/node-deployment" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Node Deployment Details
- __200__ (Ok)

``` json
{
    "nodeDeployment": {
        "id": 54,
        "application_id": 228,
        "rendering": "ssr",
        "build_command": "npm run setup",
        "after_build_command": null,
        "start_app_command": "node server\/server.js",
        "port": 8000,
        "environment_variable": [
            {
                "variable_name": "UPTIME_KUMA_PORT",
                "variable_value": "8000"
            }
        ],
        "nginx_conf": "index index.html;\n\nlocation \/ {\n    proxy_pass http:\/\/localhost:8000;\n    proxy_http_version 1.1;\n    proxy_set_header Upgrade $http_upgrade;\n    proxy_set_header Connection 'upgrade';\n    proxy_set_header Host $host;\n    proxy_cache_bypass $http_upgrade;\n}",
        "created_at": "2024-01-30 18:46:30",
        "updated_at": "2024-01-31 13:33:17"
    }
}
```

#### Node Deployment Not Found
- __404__ (Not Found)

```json
{
    "message": "Node deployment not found for the application."
}
```

#### Server Error
- __500__ (Internal Server Error)

```json
{
    "message": "Something went wrong while getting Node deployment details."
}
```