package service

import (
	"github.com/gofiber/fiber/v2"
)

type UserService interface {
	FindAll(ctx *fiber.Ctx) error
}
