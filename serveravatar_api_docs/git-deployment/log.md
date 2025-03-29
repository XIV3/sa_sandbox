# Log

Use this method to get a script log.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/git/deployment-script/{git_deployment_script}/output
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/git/deployment-script/{git_deployment_script}/output" \
  --header 'Content-Type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Script Log

- __200__ (Ok)

``` json
{
  "data": [
    {
      "output": "Do not run Composer as root\/super user! See https:\/\/getcomposer.org\/root for details\nComposer could not find a composer.json file in \/\nTo initialize a project, please create a composer.json file as described in the https:\/\/getcomposer.org\/ \"Getting Started\" section",
      "status": "error"
    }
  ]
}
```
#### Script Output Not found
- __404__ (Not Found)

```json
{
    "message": "Git deployment script output not found!"
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