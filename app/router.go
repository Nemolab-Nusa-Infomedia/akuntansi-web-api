package app

import (
	"github.com/gofiber/fiber/v2"
	"github.com/gofiber/fiber/v2/middleware/session"
	"gorm.io/gorm"
)

func SetupRoutes(app *fiber.App, db *gorm.DB, store *session.Store) {
	/*
		| -----------------------------------------------------------------
		| PREPARATIONS
		| -----------------------------------------------------------------
	*/

	baseRoute := app.Group("/api")

	userController, _ := UserInitialize(db, store)

	/*
		| -----------------------------------------------------------------
		| ROUTES
		| -----------------------------------------------------------------
	*/

	// User routes
	userRoutes := baseRoute.Group("/user")

	userRoutes.Get("/get", userController.GetAll)
}
