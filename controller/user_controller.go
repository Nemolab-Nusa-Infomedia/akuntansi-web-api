package controller

import (
	"manajemen_tugas_master/service"

	"github.com/gofiber/fiber/v2"
	"github.com/gofiber/fiber/v2/middleware/session"
)

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

func (c *UserController) SignupUser(ctx *fiber.Ctx) error {
	return nil
}

func (c *UserController) LoginUser(ctx *fiber.Ctx) error {
	return nil
}
