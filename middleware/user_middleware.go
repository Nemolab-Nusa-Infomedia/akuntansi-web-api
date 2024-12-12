package middleware

import (
	"github.com/gofiber/fiber/v2"
	"github.com/gofiber/fiber/v2/middleware/session"

	"akutansi-web-api/service"
)

func AuthUser(userService service.UserService, store *session.Store) fiber.Handler {
	return func(ctx *fiber.Ctx) error {

		return ctx.Next()
	}
}
