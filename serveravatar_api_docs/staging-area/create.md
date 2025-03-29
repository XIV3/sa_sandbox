# Create

Create a staging area.

### HTTP Request:

```js
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/staging-area
```

### Custom Parameters:

| **Parameter**            | **Required** | **Type**     | **Description**                                                                                           |
|--------------------------|--------------|--------------|-----------------------------------------------------------------------------------------------------------|
| staging_area_name    | Yes          | Alpha Dash   | The name of the staging area. Must be a valid alpha dash string (letters, numbers, hyphens, and underscores). |
| migration_server_id  | Yes          | Numeric      | The unique identifier for the migration server you are using.                                            |
| database_id          | Yes          | Numeric      | The unique identifier for the database being used in the migration.                                      |
| temp_domain          | Yes          | Boolean      | Set to `true` if you want to use a ServerAvatar temporary domain. Set to `false` if you want to use a custom domain. |
| temp_sub_domain_name | No           | String       | Required if `temp_domain` is `true`. The name of the temporary subdomain to be used with the ServerAvatar domain. |
| hostname             | No           | String       | Required if `temp_domain` is `false`. The custom hostname to be used if not using a ServerAvatar domain. |
| wordpressUrlType     | No           | Boolean      | If `true`, WordPress URLs will use HTTPS. If `false`, URLs will use HTTP.                                |

### Curl Request example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/5/servers/15/applications/88/staging-area" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "staging_area_name": "stagingareatest",
    "migration_server_id": 554,
    "database_id": 430,
    "temp_domain": 0,
    "temp_sub_domain_name": null,
    "hostname": "siteexample.tk"
  }'
```

### Response:

- __200__ (Ok)

```json
{
    "message":"Staging site process started."
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

#### Migration Server Not Found
- __404__ (Not Found)

```json
{
    "message": "Migration server not found!"
}
```

#### Another Process Running
- __500__ (Internal Server Error)
```json
{
    "message": "Please wait another process already running!"
}
```

#### Application Not Found
- __404__ (Not Found)

```json
{
    "message":"Application not found!"
}
```

#### Duplicate Application Name
- __500__ (Internal Server Error)

```json
{
  "message": "Duplicate application name found for this new server."
}
```

#### Duplicate Domain Name
- __500__ (Internal Server Error)

```json
{
  "message": "Duplicate domain name found for this new server."
}
```

#### Database Not Found
- __404__ (Not Found)

```json
{
    "message":"Database not found!"
}
```

#### Database Already Exist
- __404__ (Not Found)

```json
{
    "message":"Database already exist!"
}
```

#### Database User Already Exist
- __404__ (Not Found)

```json
{
    "message":"Database user already exist!"
}
```

#### Disk Space Error
- __500__ (Internal Server Error)
```json
{
    "message": "Staging area is failed because you do not have enough disk space available on your server!"
}
```

#### Disk Space Error
- __500__ (Internal Server Error)
```json
{
    "message": "Staging area is failed because you do not have enough disk space available on your new server!"
}
```

#### Application User Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went really wrong while creating application user!"
}
```

#### Application Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went really wrong while creating application on openlitespeed!"
}
```

#### Application Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went really wrong while creating application!"
}
```

#### Database Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went really wrong while creating database!"
}
```

#### Database User Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went really wrong while creating database user!"
}
```

#### Server Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went really wrong!"
}
```