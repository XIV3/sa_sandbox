# Restart Schedule

Set the server restart schedule.

### HTTP Request:

```js
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/restart-server
```

### Parameters:

| parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| restart_schedule | No | String | Select any one `daily`, `weekly` or `monthly`. |


### Curl Request example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/restart-server" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
        "restart_schedule": "weekly"
  }'
```

### Response:

#### Restart Schedule
- __200__ (Ok)

``` json
{
  "message": "Server restart schedule updated successfully!"
}
```

#### Organization Not Found
- __404__ (Not found)

```json
{
  "message": "Organization not found."
}
```

#### Server Not Found
- __404__ (Not Found)

```json
{
    "message": "Server not found!"
}
```

#### Server Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went really wrong!"
}