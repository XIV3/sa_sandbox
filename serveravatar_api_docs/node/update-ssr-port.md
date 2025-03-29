# Update SSR Port

Update port for the Node application(SSR) on a Node Stack server.

### HTTP Request:

```js
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/node-deployment/ssr-port
```
### Parameter:

| Parameter               | Required | Type  | Description                                    |
|:----------------------- |:-------- |:----- |:-----------------------------------------------|
| port    | No   | Numeric | Specifies the port number. |

### Curl Request example:

```sh
curl --request PATCH \
  --url "http://api.serveravatar.com/organizations/1/servers/13/applications/228/node-deployment/ssr-port" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "port": 8000
  }'
```

### Response:

#### Port Updated
- __200__ (Ok)
``` json
{
  "message": "Port updated successfully!"
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
    "message": "An error occurred while updating port."
}
```