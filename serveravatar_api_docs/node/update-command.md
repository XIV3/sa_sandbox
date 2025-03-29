# Update Command

Update the build and after-build commands for the Node application on a Node Stack server.

### HTTP Request:

```js
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/node-deployment/command
```
### Parameter:

| Parameter            | Required | Type    | Description                                            |
|:--------------------- |:-------- |:------- |:-------------------------------------------------------|
| rendering            | Yes      | String  | Rendering type of the Node application (static, ssr, csr). Must be one of: static, ssr, csr. |
| build_command        | Yes      | Array   | Build command for the Node application.                |
| after_build_command  | No       | Array   | Optional command to be executed after the build process. Required if rendering is static or csr. |

### Curl Request example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/1/servers/13/applications/223/node-deployment/command" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "rendering": "ssr",
    "build_command": "npm run build",
    "after_build_command": "npm run start"
  }'
```

### Response:

#### Command Updated
- __200__ (Ok)
``` json
{
  "message": "Command Updated Successfully!"
}
```

#### Node Deployment Not Found
- __404__ (Not Found)

```json
{
    "message": "Node deployment not found for the application."
}
```

#### Rendering Mismatch
- __500__ (Internal Server Error)

```json
{
    "message": "Requested rendering not match with Node deployment rendering."
}
```

#### Server Error
- __500__ (Internal Server Error)

```json
{
    "message": "An error occurred while updating environment variables."
}
```