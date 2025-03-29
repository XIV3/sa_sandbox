# Log

Retrieve pm2 log for a specific SSR Node application on a Node Stack server.

### HTTP Request:

```js
POST https://api.serveravatar.com/servers/{server}/applications/{application}/node-deployment/pm2-log
```

### Parameters:

| Parameter           | Required | Type      | Description                                                                                                    |
|:-------------------- |:-------- |:--------- |:-------------------------------------------------------------------------------------------------------------- |
| file                | Yes      | String    | The log file name. It should be a string and must be either `error` or `out`.                                  |
| selectTailLines     | No       | Boolean   | Optional boolean parameter. If provided, it indicates whether to select tail lines.                             |
| numberOfTailLines   | No       | Numeric   | Optional numeric parameter. It is required if `selectTailLines` is true. Should be a minimum of 1.              |

### Curl Request example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/servers/{server}/applications/{application}/node-deployment/pm2-log" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "file": "error",
    "selectTailLines": true,
    "numberOfTailLines": 10
  }'
```

### Response:

#### Log Content
- __200__ (Ok)

``` json

  "output": "Error log content..."
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
    "message": "Something went really wrong!"
}
```