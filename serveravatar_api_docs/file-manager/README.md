# List

Get the list of files of the particular application.


### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/file-managers?path=
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/servers/15/applications/92/file-managers?path=" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### File List:

- __200__ (Ok)

```json
{
    "list": [
        {
            "type": "directory",
            "name": "conf",
            "mode": "0755",
            "prot": "drwxr-xr-x",
            "user": "htyDFG7jugd",
            "group": "htyDFG7jugd",
            "size": "4.0K",
            "time": "Mar  1 10:20",
            "contents": [],
            "permissions": {
                "user": {
                    "read": "r",
                    "write": "w",
                    "execute": "x"
                },
                "group": {
                    "read": "r",
                    "write": "-",
                    "execute": "x"
                },
                "other": {
                    "read": "r",
                    "write": "-",
                    "execute": "x"
                }
            },
            "path": "/conf"
        },
        {
            "type": "directory",
            "name": "logs",
            "mode": "0755",
            "prot": "drwxr-xr-x",
            "user": "htyDFG7jugd",
            "group": "htyDFG7jugd",
            "size": "4.0K",
            "time": "Mar  1 10:21",
            "contents": [],
            "permissions": {
                "user": {
                    "read": "r",
                    "write": "w",
                    "execute": "x"
                },
                "group": {
                    "read": "r",
                    "write": "-",
                    "execute": "x"
                },
                "other": {
                    "read": "r",
                    "write": "-",
                    "execute": "x"
                }
            },
            "path": "/logs"
        },
        {
            "type": "directory",
            "name": "public_html",
            "mode": "0755",
            "prot": "drwxr-xr-x",
            "user": "htyDFG7jugd",
            "group": "htyDFG7jugd",
            "size": "4.0K",
            "time": "Mar  1 10:21",
            "contents": [],
            "permissions": {
                "user": {
                    "read": "r",
                    "write": "w",
                    "execute": "x"
                },
                "group": {
                    "read": "r",
                    "write": "-",
                    "execute": "x"
                },
                "other": {
                    "read": "r",
                    "write": "-",
                    "execute": "x"
                }
            },
            "path": "/public_html"
        }
    ],
    "current_path": "/home/htyDFG7jugd/ServerAvatar",
    "path": ""
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

#### Application Not Found
- __404__ (Not Found)

```json
{
    "message": "Application not found!"
}
```

#### Server Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went really wrong!"
}
```
