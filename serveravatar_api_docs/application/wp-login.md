# WP Login

## Get WP Admins

Get WordPress administrators for an application.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/wordpress/admins
```

### Curl request Example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/wordpress/admins" \
  --header 'content-type: application/json' \
  --header 'Authorization: Bearer <YOUR API TOKEN>'
```

### Response:

#### Successful Response

- __200__ (Ok)

``` json
{
    "message": "WordPress Admin List",
    "data": {
        "users": [
            {
                "id": 1,
                "name": "magicwplogin",
                "email": "magicwplogin@gmail.com",
                "username": "magicwplogin"
            }
        ]
    }
}
```

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
    "message": "Something goes wrong while fetch wordpress admins!"
}
```

## Create Magic Link

Create a magic login link for a WordPress user.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/wordpress/admins/{username}/create-magic-link
```

### Curl Request Example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/wordpress/admins/{username}/create-magic-link" \
  --header 'Content-Type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' 
```

### Response:

#### Successful Response

- __200__ (Ok)

``` json
{
    "message": "Magic Login Link Created Successfully!!",
    "data": {
     "magic_login_link" : "http://magicwplogin.satesting1.click/wp-magic-login.php?token=4ILHlJnFndlszydJSVdwn1JH2TD3Qd0LHd3_8R1sI&username=magicwplogin"
    }
}
```

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
    "message": "Something goes wrong while create magic link!"
}
```