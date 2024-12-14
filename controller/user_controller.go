package controller

import (
	"github.com/gofiber/fiber/v2"
	"github.com/gofiber/fiber/v2/middleware/session"

	"akutansi-web-api/model/web"
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
	users, err := c.userService.FindAllUsers()

	if err != nil {
		return ctx.Status(fiber.StatusInternalServerError).JSON(web.ErrorResponse{
			Status:  fiber.StatusInternalServerError,
			Message: "Internal server error",
		})
	}

	return ctx.Status(fiber.StatusOK).JSON(web.SuccessResponse{
		Status:  fiber.StatusOK,
		Message: "Success get all users",
		Data:    users,
	})
}
