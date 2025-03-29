# Add Database

Add Database to Application

### HTTP Request:

```js
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/add-database
```

### Parameter:

| Parameter           | Required | Type   | Description                                |
|---------------------|----------|--------|--------------------------------------------|
| database_server_id  | Yes      | Numeric| ID of the database server to which the specific database is added for the application.       |
| database_id         | Yes      | Numeric| ID of the specific database to be added to the application.              |

### Curl Request Example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/add-database" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "database_server_id": 1,
    "database_id": 12
  }'
```

### Response Examples:

#### Database Added Successfully
- __200__ (Ok)

```json
{
  "message": "Database added successfully."
}
```

#### Application Not Found
- __404__ (Not Found)

```json
{
  "message": "The application is not associated with the specified server."
}
```

#### Server Not Found
- __404__ (Not Found)
```json
{
    "message": "The selected server is not associated with this organization."
}
```

#### Database Not Found
- __404__ (Not Found)

```json
{
  "message": "The selected database was not found."
}
```

#### Server Error
- __500__ (Internal Server Error)

```json
{
  "message": "Something went wrong."
}
```