USE [DB_SOLVUS]
GO

/****** Object:  Table [dbo].[TAR_ASESMEN_DOKTER]    Script Date: 11/30/2021 2:57:22 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[TAR_ASESMEN_DOKTER](
	[FN_ID] [bigint] IDENTITY(1,1) NOT NULL,
	[FD_DATE] [nvarchar](255) NULL,
	[FS_MR] [nvarchar](255) NULL,
	[FS_KD_LAYANAN] [nvarchar](255) NULL,
	[FS_PROFESI] [nvarchar](255) NULL,
	[FS_USER] [nvarchar](255) NULL,
	[FS_DPJP] [nvarchar](255) NULL,
	[FS_VERIFIED_BY] [nvarchar](255) NULL,
	[FS_REGISTER] [nvarchar](255) NULL,
	[FS_KD_PEG] [nvarchar](255) NULL,
	[FS_FROM] [nvarchar](255) NULL,
	[FS_TYPE] [nvarchar](255) NULL,
	[FJ_DS] [nvarchar](max) NULL,
	[FS_RPD] [nvarchar](255) NULL,
	[FS_RO] [nvarchar](255) NULL,
	[FJ_DO] [nvarchar](max) NULL,
	[FJ_PEMERIKSAAN_FISIK] [nvarchar](max) NULL,
	[FS_PEMERIKSAAN_PENUNJANG] [nvarchar](255) NULL,
	[FS_TINDAKAN_TERAPI] [nvarchar](255) NULL,
	[FS_KODE_DIAGNOSIS] [nvarchar](255) NULL,
	[FJ_DIAGNOSA_SEKUNDER] [nvarchar](max) NULL,
	[FS_DETAIL_DIAGNOSIS] [nvarchar](255) NULL,
	[FJ_RENCANA_TINDAK_LANJUT] [nvarchar](max) NULL,
	[created_at] [datetime] NULL,
	[updated_at] [datetime] NULL,
PRIMARY KEY CLUSTERED 
(
	[FN_ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO


