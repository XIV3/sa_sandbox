
# Sync

Sync between your staging and production site.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/sync
```
### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/servers/15/applications/88/sync" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

- __200__ (Ok)

``` json
{
  "message":"Sync staging to production started."
}
```

#### Permission Error
- __404__ (Not Found)

```json
{
    "message": "You cannot perform this action!"
}
```

#### Permission Error
- __404__ (Not Found)

```json
{
    "message": "You cannot perform this action, Please contact support!"
}
```

#### Another Process Running
- __500__ (Internal Server Error)
```json
{
    "message": "Please wait another process already running!"
}
```

#### Staging Server Not Found
- __404__ (Not Found)
```json
{
    "message": "Staging server not found!"
}
```

#### Staging Application Not Found
- __404__ (Not Found)
```json
{
    "message": "Staging application not found!"
}
```

#### Staging Database Not Found
- __404__ (Not Found)
```json
{
    "message": "Staging database not found!"
}
```

#### Disk Space Error
- __500__ (Internal Server Error)
```json
{
    "message": "Staging site sync is failed because you do not have enough disk space available on your staging server!"
}
```

#### Disk Space Error
- __500__ (Internal Server Error)
```json
{
    "message": "Staging site sync is failed because you do not have enough disk space available on your production server!"
}
```

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message": "Organization not found!"
}
```

#### Application Not Found
- __404__ (Not Found)
```json
{
    "message": "Application not found!"
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