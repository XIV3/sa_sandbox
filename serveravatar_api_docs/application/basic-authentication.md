# Basic Authentication

This API endpoint allows users to manage basic authentication for a specified application on a server. It includes retrieving, creating, and disabling basic authentication.

## Get

#### HTTP Request:

```
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/basic-authentication
```

### Example Request

#### cURL Request Example

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/basic-authentication" \
  --header 'Authorization: Bearer <Your API Token>'
```

### Success Response

- __200__ (OK)

```json
{
    "basicAuth": {
        "id": 1,
        "server_id": 27,
        "application_id": 54,
        "username": "test1234",
        "password": "test1234",
        "enabled": false,
        "created_at": "2024-10-07 15:08:54",
        "updated_at": "2024-10-07 15:20:51"
    }
}
```

### Error Responses

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message": "Organization not found!"
}
```

#### Application Not found
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
  "message": "Something went wrong!"
}
```

---

## Create

#### HTTP Request:

```
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/basic-authentication
```

### Request Body

| Parameter | Required | Type   | Description                                 |
|:----------|:--------|:-------|:--------------------------------------------|
| username  | Yes     | String | The username for basic authentication.     |
| password  | Yes     | String | The password for basic authentication.     |

### Example Request

#### cURL Request Example

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/basic-authentication" \
  --header 'Content-Type: application/json' \
  --header 'Authorization: Bearer <Your API Token>' \
  --data '{
    "username": "your_username",
    "password": "your_password"
  }'
```

### Success Response

- __200__ (OK)

```json
{
    "message": "Basic authentication created successfully!",
    "basicAuthentication": {
        "id": 1,
        "server_id": 27,
        "application_id": 54,
        "username": "test1234",
        "password": "test1234",
        "enabled": true,
        "created_at": "2024-10-07 15:08:54",
        "updated_at": "2024-10-08 15:50:59"
    }
}
```

### Error Responses

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message": "Organization not found!"
}
```

#### Application Not found
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
  "message": "Something went wrong!"
}
```

---

## Disable

#### HTTP Request:

```
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/basic-authentication/{basic_authentication}
```

### Example Request

#### cURL Request Example

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/basic-authentication/{basic_authentication}" \
  --header 'Authorization: Bearer <Your API Token>'
```

### Success Response

- __200__ (OK)

```json
{
  "message": "Basic authentication disabled successfully!"
}
```

### Error Responses

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message": "Organization not found!"
}
```

#### Application Not found
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
  "message": "Something went wrong!"
}
```