## lara-crud-api

Guest users can perform read posts, while creation, updation and deletion requires authentication.
Only owner of a post is able to edit and delete it.

Use `Accept: application/json`

### Endpoints
```
post /users/signup - data: name, username, email, password
post /users/login - data: email, password
get /users
get /users/{id}
get /users/{id}/posts
get /posts
get /posts/{id}
```
### Authenticated Endpoints
Use `Authorization: Bearer [auth_token]`
```
post /posts
patch /posts/{id}
delete /posts/{id}
get /users/logout/current - unsets current auth_token
get /users/logout/all - unset all auth_token
```
