# Update Nginx Configuration

Update Nginx configuration for the Node application on a Node Stack server.

### HTTP Request:

```js
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/node-deployment/nginx-conf
```

### Parameters:

| Parameter         | Required | Type   | Description                                    |
|:------------------ |:-------- |:------ |:-----------------------------------------------|
| config_content     | Yes      | String | Updated Nginx configuration content.           |


### Curl Request example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/1/servers/13/applications/223/node-deployment/nginx-conf" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "config_content": "Updated Nginx configuration content..."
  }'
```

### Response:

#### Nginx Configuration Updated
- __200__ (Ok)
``` json
{
  "message": "Nginx Configuration Updated Successfully!"
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
    "message": "An error occurred while updating Nginx configuration."
}
```