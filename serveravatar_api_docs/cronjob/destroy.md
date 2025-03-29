# Destroy

Delete the cronjob schedule. \
**Note**: the automatic process will stop immidiatly once you deleted the cronjob.

### HTTP Request:

```js
DELETE https://api.serveravatar.com/organizations/{organization}/servers/{server}/cronjobs/{cronjob}
```

### Curl Request example:

```sh
curl --request DELETE \
  --url "https://api.serveravatar.com/organizations/5/servers/15/cronjobs/63" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Cronjob Delete
- __200__ (Ok)

```json
{
    "message": "Cronjob was successfully deleted!"
}
```

#### Cronjob Not Found
- __404__ (Not Found)

```json
{
    "message":"Cronjob not found!"
}
```

#### Organization not found
- __404__ (Not Found)

```json
{
    "message": "Organization not found!"
}
```

#### Server not found
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
    "message":"Something went wrong while deleting cronjob!"
}
```