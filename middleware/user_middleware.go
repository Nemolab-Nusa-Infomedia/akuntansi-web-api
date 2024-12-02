package middleware

import (
	"manajemen_tugas_master/service"

	"github.com/gofiber/fiber/v2"
	"github.com/gofiber/fiber/v2/middleware/session"
)

func AuthUser(userService service.UserService, store *session.Store) fiber.Handler {
	return func(ctx *fiber.Ctx) error {

		return ctx.Next()
	}
}
