USE [DB_SOLVUS]
GO

/****** Object:  Table [dbo].[TAR_MODEL_HAS_PERMISSIONS]    Script Date: 11/30/2021 3:05:17 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[TAR_MODEL_HAS_PERMISSIONS](
	[permission_id] [bigint] NOT NULL,
	[model_type] [nvarchar](255) NOT NULL,
	[model_id] [bigint] NOT NULL,
 CONSTRAINT [model_has_permissions_permission_model_type_primary] PRIMARY KEY CLUSTERED 
(
	[permission_id] ASC,
	[model_id] ASC,
	[model_type] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

ALTER TABLE [dbo].[TAR_MODEL_HAS_PERMISSIONS]  WITH CHECK ADD  CONSTRAINT [model_has_permissions_permission_id_foreign] FOREIGN KEY([permission_id])
REFERENCES [dbo].[TAR_PERMISSIONS] ([id])
ON DELETE CASCADE
GO

ALTER TABLE [dbo].[TAR_MODEL_HAS_PERMISSIONS] CHECK CONSTRAINT [model_has_permissions_permission_id_foreign]
GO


