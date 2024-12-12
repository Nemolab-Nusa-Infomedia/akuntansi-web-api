package main

import (
	"log"
	"os"
	"time"

	"github.com/gofiber/fiber/v2"
	"github.com/gofiber/fiber/v2/middleware/cors"
	"github.com/gofiber/fiber/v2/middleware/logger"
	"github.com/gofiber/fiber/v2/middleware/recover"
	"github.com/gofiber/fiber/v2/middleware/session"
	"github.com/gofiber/swagger"

	"akutansi-web-api/app"
	"akutansi-web-api/helper"

	_ "akutansi-web-api/docs"
)

// @title         Akutansi Web API
// @description   API documentation

var store *session.Store

func main() {
	// Load Environment
	helper.LoadEnv()

	// Load Database
	db, err := app.ConnectDB()
	if err != nil {
		log.Fatal(err.Error())
	}

	// Fiber Application Initialize
	fiberApp := fiber.New()

	fiberApp.Get("/swagger/*", swagger.HandlerDefault)

	fiberApp.Use(cors.New(cors.Config{
		AllowOrigins:     os.Getenv("ALLOW_ORIGIN"),
		AllowMethods:     os.Getenv("ALLOW_METHOD"),
		AllowHeaders:     os.Getenv("ALLOW_HEADER"),
		ExposeHeaders:    os.Getenv("EXPOSE_HEADER"),
		AllowCredentials: os.Getenv("ALLOW_CREDENTIAL") == "true",
		MaxAge:           int((12 * time.Hour).Seconds()),
	}))
	fiberApp.Use(logger.New())
	fiberApp.Use(recover.New())

	// Session Initialize
	store = session.New()

	// Route Initialize
	app.SetupRoutes(fiberApp, db, store)

	// Running Application
	log.Fatal(fiberApp.Listen(":" + os.Getenv("PORT")))
}
