package controller

import (
	"github.com/gofiber/fiber/v2"
	"github.com/gofiber/fiber/v2/middleware/session"

	"akutansi-web-api/service"
)

/*
| -----------------------------------------------------------------
| PREPARATION
| -----------------------------------------------------------------
*/

type UserController struct {
	userService service.UserService
	store       *session.Store
}

func NewUserController(userService service.UserService, store *session.Store) *UserController {
	return &UserController{
		userService: userService,
		store:       store,
	}
}

/*
| -----------------------------------------------------------------
| FUNCTIONS
| -----------------------------------------------------------------
*/

func (c *UserController) GetAll(ctx *fiber.Ctx) error {
	return c.userService.FindAll(ctx)
}
