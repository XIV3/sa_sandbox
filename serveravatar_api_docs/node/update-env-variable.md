# Update Environment Variable

Update environment variables for the Node application on a Node Stack server.

### HTTP Request:

```js
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/node-deployment/environment-variable
```
### Parameter:

| Parameter               | Required | Type  | Description                                    |
|:----------------------- |:-------- |:----- |:-----------------------------------------------|
| environment_variable    | Yes      | Array | An array of environment variables. Each variable must have both variable name and variable value. |

### Curl Request example:

```sh
curl --request PATCH \
  --url "http://api.serveravatar.com/organizations/1/servers/13/applications/228/node-deployment/environment-variable" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "environment_variable": [{"variable_name": "name", "variable_value": "value"}]
  }'
```

### Response:

#### Environment Variable Updated
- __200__ (Ok)
``` json
{
  "message": "Environment Variable Updated Successfully!"
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
    "message": "An error occurred while updating environment variables."
}
```