# Script

## Create

Use this method to create a git deployment script.

### HTTP Request:

```js
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/git/script
```

### Curl Request example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/git/script" \
  --header 'Content-Type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "script":"composer dump-autoload\ncomposer update"
  }'
```

### Response:

#### Create a script

- __200__ (Ok)

``` json
{
  "message":"Deployment script store successfully!"
}
```
#### Git Deployment Not found
- __404__ (Not Found)

```json
{
    "message": "Git deployment not found!"
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
    "message": "Something went really wrong!"
}
```

## Show

Use this method to get a git deployment script.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/git/script
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/git/script" \
  --header 'Content-Type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Script

- __200__ (Ok)

``` json
{
    "vars": {
        "{PHP70}": "\/usr\/bin\/php7.0",
        "{PHP71}": "\/usr\/bin\/php7.1",
        "{PHP72}": "\/usr\/bin\/php7.2",
        "{PHP73}": "\/usr\/bin\/php7.3",
        "{PHP74}": "\/usr\/bin\/php7.4",
        "{PHP80}": "\/usr\/bin\/php8.0",
        "{PHP81}": "\/usr\/bin\/php8.1"
    },
    "deploymentScript": "composer install --no-dev --optimize-autoloader\nphp artisan key:generate"
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
```