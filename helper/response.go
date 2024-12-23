package helper

import "github.com/gofiber/fiber/v2"

type Response struct {
	Status  int    `json:"status" example:"200"`
	Message string `json:"message" example:"Success message"`
	Data    any    `json:"data"`
}

func GetResponse(ctx *fiber.Ctx, response *Response) error {
	return ctx.Status(response.Status).JSON(response)
}
