# Create

Create an application site-clone.


### HTTP Request:

```js
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/site-migrations
```

### Custom Parameters:

| **Parameter**            | **Required** | **Type**  | **Description**                                                                                           |
|--------------------------|--------------|-----------|-----------------------------------------------------------------------------------------------------------|
| site_type            | Yes          | String    | The type of site to be cloned. Must be set to `clone`.                                                   |
| migration_server_id  | Yes          | Numeric   | The unique identifier for the migration server you are using.                                            |
| type                 | Yes          | String    | Specifies the type of migration. Choose one of the following: `filesystem`, `database`, or `application`. |
| application_id       | Yes          | Numeric   | The unique identifier of the existing application being cloned.
| systemUser           | No          | String       | Specifies the type of system user: `new` to create a new system user, or `existing` to use an existing application user. |
| systemUserInfo[username] | No      | String    | Required if systemUser is `new`. Specifies the username for the new system user.                |
| systemUserInfo[password] | No      | String    | Required if systemUser is `new`. Specifies the password for the new system user.                |                                          |
| application_name     | No           | String    | Required if `type` is `application` or `filesystem`. The new name for the application being cloned.      |
| database_id          | No           | Numeric   | Required if `type` is `application` or `database`. The unique identifier of the existing database being cloned. |
| database_name        | No           | String    | Required if `type` is `application` or `database`. The new name for the database being cloned.           |
| wordpressUrlType     | No           | Boolean   | If `true`, WordPress URLs will use HTTPS. If `false`, URLs will use HTTP.                                |


### Curl Request example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/5/servers/15/site-migrations" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "site_type": "clone",
    "migration_server_id": 554,
    "type": "application",
    "application_id": 605,
    "systemUser" : "existing",
    "application_name": "appClone",
    "database_id": 413,
    "database_name": "databaseClone"
  }'
```

### Response:

- __200__ (Ok)

```json
{
    "message": "Site clone process started."
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
    "message": "Please wait another site migration already running!"
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
    "message": "Site clone is failed because you do not have enough disk space available on your server!"
}
```

#### Disk Space Error
- __500__ (Internal Server Error)
```json
{
    "message": "Site clone is failed because you do not have enough disk space available on your new server!"
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