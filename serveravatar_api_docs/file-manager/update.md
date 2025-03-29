# Update file content

Use this method to update the content of the file..

### HTTP Request:

```js
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/file-managers/file
```
### Parameter:

| Parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| body | No | String | Your file content. |
| filename | Yes | String | Name of file. |
| path | No | String | A path of file. |


### Curl Request example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/5/servers/15/applications/92/file-managers/file" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
      "body": "<?php\nTest\n<?php",
      "path": "/public_html",
      "filename": "api.php"
    }'
```

### Response:

#### Update File Content:

- __200__ (Ok)

```json
{
    "message": "Successfully saved."
}
```

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message": "Organization not found!"
}
```

#### Server Not Found
- __404__ (Not Found)

```json
{
    "message": "Server not found!"
}
```

#### Application Not Found
- __404__ (Not Found)

```json
{
    "message": "Application not found!"
}
```

#### Server Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went really wrong!"
}
```
